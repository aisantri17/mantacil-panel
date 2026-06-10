import React, { memo, useEffect, useRef, useState } from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faEthernet, faHdd, faMemory, faMicrochip, faServer } from '@fortawesome/free-solid-svg-icons';
import { Link } from 'react-router-dom';
import { Server } from '@/api/server/getServer';
import getServerResourceUsage, { ServerPowerState, ServerStats } from '@/api/server/getServerResourceUsage';
import { bytesToString, ip, mbToBytes } from '@/lib/formatters';
import tw from 'twin.macro';
import GreyRowBox from '@/components/elements/GreyRowBox';
import Spinner from '@/components/elements/Spinner';
import styled from 'styled-components/macro';
import isEqual from 'react-fast-compare';

// Determines if the current value is in an alarm threshold so we can show it in red rather
// than the more faded default style.
const isAlarmState = (current: number, limit: number): boolean => limit > 0 && current / (limit * 1024 * 1024) >= 0.9;

const Icon = memo(
    styled(FontAwesomeIcon)<{ $alarm: boolean }>`
        ${(props) => (props.$alarm ? tw`text-red-400` : tw`text-neutral-500`)};
    `,
    isEqual
);

const IconDescription = styled.p<{ $alarm: boolean }>`
    ${tw`text-sm ml-2`};
    ${(props) => (props.$alarm ? tw`text-white` : tw`text-neutral-400`)};
`;

const StatusIndicatorBox = styled(Link)<{ $status: ServerPowerState | undefined }>`
    ${tw`relative flex flex-col justify-between p-6 rounded-2xl transition-all duration-500 no-underline cursor-pointer`};
    background: rgba(26, 49, 44, 0.45);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(246, 193, 91, 0.15);
    box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
    min-height: 250px;
    transform-style: preserve-3d;
    
    &:hover {
        transform: translateY(-10px) rotateX(5deg) rotateY(-5deg) scale(1.02);
        box-shadow: 20px 20px 60px rgba(0,0,0,0.5), -20px -20px 60px rgba(255,255,255,0.02);
        border-color: rgba(246, 193, 91, 0.5);
    }

    & .status-bar {
        ${tw`absolute top-0 left-0 w-full h-1.5 opacity-80 transition-all duration-150 rounded-t-2xl`};
        ${({ $status }) =>
            !$status || $status === 'offline'
                ? tw`bg-red-500`
                : $status === 'running'
                ? tw`bg-green-500 text-green-500 shadow-[0_0_15px_currentColor]`
                : tw`bg-yellow-500`};
    }
`;

type Timer = ReturnType<typeof setInterval>;

export default ({ server, className }: { server: Server; className?: string }) => {
    const interval = useRef<Timer>(null) as React.MutableRefObject<Timer>;
    const [isSuspended, setIsSuspended] = useState(server.status === 'suspended');
    const [stats, setStats] = useState<ServerStats | null>(null);

    const getStats = () =>
        getServerResourceUsage(server.uuid)
            .then((data) => setStats(data))
            .catch((error) => console.error(error));

    useEffect(() => {
        setIsSuspended(stats?.isSuspended || server.status === 'suspended');
    }, [stats?.isSuspended, server.status]);

    useEffect(() => {
        if (isSuspended) return;

        getStats().then(() => {
            interval.current = setInterval(() => getStats(), 30000);
        });

        return () => {
            interval.current && clearInterval(interval.current);
        };
    }, [isSuspended]);

    const alarms = { cpu: false, memory: false, disk: false };
    if (stats) {
        alarms.cpu = server.limits.cpu === 0 ? false : stats.cpuUsagePercent >= server.limits.cpu * 0.9;
        alarms.memory = isAlarmState(stats.memoryUsageInBytes, server.limits.memory);
        alarms.disk = server.limits.disk === 0 ? false : isAlarmState(stats.diskUsageInBytes, server.limits.disk);
    }

    const diskLimit = server.limits.disk !== 0 ? bytesToString(mbToBytes(server.limits.disk)) : 'Unlimited';
    const memoryLimit = server.limits.memory !== 0 ? bytesToString(mbToBytes(server.limits.memory)) : 'Unlimited';
    const cpuLimit = server.limits.cpu !== 0 ? server.limits.cpu + ' %' : 'Unlimited';

    return (
        <StatusIndicatorBox to={`/server/${server.id}`} className={className} $status={stats?.status}>
            <div className={'status-bar'} />
            
            <div css={tw`flex flex-col items-center text-center mt-2`}>
                <div css={tw`w-16 h-16 rounded-full bg-black/30 flex items-center justify-center mb-4 border border-white/10 shadow-inner`}>
                    <FontAwesomeIcon icon={faServer} css={tw`text-3xl text-yellow-400 drop-shadow-md`} />
                </div>
                <h3 css={tw`text-xl font-bold text-white tracking-wide break-words w-full`}>{server.name}</h3>
                <div css={tw`flex items-center justify-center mt-2 bg-black/40 px-3 py-1 rounded-full border border-white/5`}>
                    <FontAwesomeIcon icon={faEthernet} css={tw`text-xs text-neutral-400 mr-2`} />
                    <p css={tw`text-xs font-mono text-neutral-300`}>
                        {server.allocations
                            .filter((alloc) => alloc.isDefault)
                            .map((allocation) => (
                                <React.Fragment key={allocation.ip + allocation.port.toString()}>
                                    {allocation.alias || ip(allocation.ip)}:{allocation.port}
                                </React.Fragment>
                            ))}
                    </p>
                </div>
            </div>

            <div css={tw`mt-6 bg-black/20 rounded-xl p-4 border border-white/5 flex-1 flex flex-col justify-end`}>
                {!stats || isSuspended ? (
                    isSuspended ? (
                        <div css={tw`text-center`}>
                            <span css={tw`bg-red-500/20 border border-red-500/50 rounded-full px-3 py-1 text-red-300 text-xs uppercase tracking-wider font-bold`}>
                                {server.status === 'suspended' ? 'Ditangguhkan' : 'Kesalahan Koneksi'}
                            </span>
                        </div>
                    ) : server.isTransferring || server.status ? (
                        <div css={tw`text-center`}>
                            <span css={tw`bg-neutral-500/20 border border-neutral-500/50 rounded-full px-3 py-1 text-neutral-300 text-xs uppercase tracking-wider font-bold`}>
                                {server.isTransferring
                                    ? 'Mentransfer'
                                    : server.status === 'installing'
                                    ? 'Menginstal'
                                    : server.status === 'restoring_backup'
                                    ? 'Memulihkan Cadangan'
                                    : 'Tidak Tersedia'}
                            </span>
                        </div>
                    ) : (
                        <div css={tw`flex justify-center`}><Spinner size={'small'} /></div>
                    )
                ) : (
                    <div css={tw`grid grid-cols-3 gap-2`}>
                        <div css={tw`flex flex-col items-center p-2 rounded-lg bg-black/30`}>
                            <Icon icon={faMicrochip} $alarm={alarms.cpu} css={tw`mb-1 text-lg`} />
                            <IconDescription $alarm={alarms.cpu} css={tw`ml-0 font-mono text-xs mb-0.5`}>
                                {stats.cpuUsagePercent.toFixed(1)}%
                            </IconDescription>
                        </div>
                        <div css={tw`flex flex-col items-center p-2 rounded-lg bg-black/30`}>
                            <Icon icon={faMemory} $alarm={alarms.memory} css={tw`mb-1 text-lg`} />
                            <IconDescription $alarm={alarms.memory} css={tw`ml-0 font-mono text-[10px] mb-0.5 whitespace-nowrap`}>
                                {bytesToString(stats.memoryUsageInBytes)}
                            </IconDescription>
                        </div>
                        <div css={tw`flex flex-col items-center p-2 rounded-lg bg-black/30`}>
                            <Icon icon={faHdd} $alarm={alarms.disk} css={tw`mb-1 text-lg`} />
                            <IconDescription $alarm={alarms.disk} css={tw`ml-0 font-mono text-[10px] mb-0.5 whitespace-nowrap`}>
                                {bytesToString(stats.diskUsageInBytes)}
                            </IconDescription>
                        </div>
                    </div>
                )}
            </div>
        </StatusIndicatorBox>
    );
};
