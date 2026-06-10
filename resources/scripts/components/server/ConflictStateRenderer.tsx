import React from 'react';
import { ServerContext } from '@/state/server';
import ScreenBlock from '@/components/elements/ScreenBlock';
import ServerInstallSvg from '@/assets/images/server_installing.svg';
import ServerErrorSvg from '@/assets/images/server_error.svg';
import ServerRestoreSvg from '@/assets/images/server_restore.svg';

export default () => {
    const status = ServerContext.useStoreState((state) => state.server.data?.status || null);
    const isTransferring = ServerContext.useStoreState((state) => state.server.data?.isTransferring || false);
    const isNodeUnderMaintenance = ServerContext.useStoreState(
        (state) => state.server.data?.isNodeUnderMaintenance || false
    );

    return status === 'installing' || status === 'install_failed' || status === 'reinstall_failed' ? (
        <ScreenBlock
            title={'Menjalankan Installer'}
            image={ServerInstallSvg}
            message={'Server Anda akan segera siap, silakan coba lagi dalam beberapa menit.'}
        />
    ) : status === 'suspended' ? (
        <ScreenBlock
            title={'Server Dibekukan (Suspended)'}
            image={ServerErrorSvg}
            message={'Server Anda telah dibekukan sementara oleh MantaCil Security. Hal ini biasanya disebabkan oleh deteksi aktivitas ilegal (seperti DDoS/Flood) atau penggunaan CPU yang ekstrim (>95%). Silakan hubungi Administrator untuk informasi lebih lanjut.'}
        />
    ) : isNodeUnderMaintenance ? (
        <ScreenBlock
            title={'Node dalam Pemeliharaan'}
            image={ServerErrorSvg}
            message={'Node tempat server ini berada sedang dalam masa pemeliharaan (maintenance).'}
        />
    ) : (
        <ScreenBlock
            title={isTransferring ? 'Sedang Mentransfer' : 'Memulihkan dari Cadangan'}
            image={ServerRestoreSvg}
            message={
                isTransferring
                    ? 'Server Anda sedang ditransfer ke node baru, silakan periksa kembali nanti.'
                    : 'Server Anda sedang dipulihkan dari cadangan (backup), silakan periksa kembali dalam beberapa menit.'
            }
        />
    );
};
