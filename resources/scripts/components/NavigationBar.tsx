import * as React from 'react';
import { useState } from 'react';
import { Link, NavLink } from 'react-router-dom';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faCogs, faLayerGroup, faSignOutAlt, faShoppingCart } from '@fortawesome/free-solid-svg-icons';
import { useStoreState } from 'easy-peasy';
import { ApplicationStore } from '@/state';
import SearchContainer from '@/components/dashboard/search/SearchContainer';
import tw, { theme } from 'twin.macro';
import styled from 'styled-components/macro';
import http from '@/api/http';
import SpinnerOverlay from '@/components/elements/SpinnerOverlay';
import Tooltip from '@/components/elements/tooltip/Tooltip';
import Avatar from '@/components/Avatar';

const RightNavigation = styled.div`
    & > a,
    & > button,
    & > .navigation-link {
        ${tw`flex items-center h-full no-underline text-neutral-200 px-6 cursor-pointer transition-all duration-150 rounded-full mx-1`};

        &:active,
        &:hover {
            ${tw`text-yellow-400 bg-white/10`};
        }

        &.active {
            ${tw`text-yellow-400 bg-white/20 shadow-inner`};
        }
    }
`;

export default () => {
    const name = useStoreState((state: ApplicationStore) => state.settings.data!.name);
    const rootAdmin = useStoreState((state: ApplicationStore) => state.user.data!.rootAdmin);
    const [isLoggingOut, setIsLoggingOut] = useState(false);

    const onTriggerLogout = () => {
        setIsLoggingOut(true);
        http.post('/auth/logout').finally(() => {
            // @ts-expect-error this is valid
            window.location = '/';
        });
    };

    return (
        <div className={'w-full pt-4 px-4 flex justify-center sticky top-0 z-50'}>
            <SpinnerOverlay visible={isLoggingOut} />
            <div className={'glass-pill flex items-center h-[3.5rem] w-full max-w-[800px] px-6 shadow-2xl transition-all duration-300'}>
                <div id={'logo'} className={'flex-1'}>
                    <Link
                        to={'/'}
                        className={
                            'text-2xl font-header font-bold px-4 no-underline text-white drop-shadow-md hover:text-yellow-400 transition-colors duration-150'
                        }
                    >
                        {name}
                    </Link>
                </div>
                <RightNavigation className={'flex h-full items-center justify-center'}>
                    <SearchContainer />
                    
                    {/* MantaCil Store Button */}
                    <Tooltip placement={'bottom'} content={'Beli Server + Subdomain (Rp5k)'}>
                        <a href={'https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20mau%20beli%20paket%20Server%20+%20Subdomain%20seharga%20Rp5.000!'} target="_blank" rel={'noreferrer'} className={'text-green-400 hover:text-green-300'}>
                            <FontAwesomeIcon icon={faShoppingCart} />
                        </a>
                    </Tooltip>

                    <Tooltip placement={'bottom'} content={'Dasbor'}>
                        <NavLink to={'/'} exact>
                            <FontAwesomeIcon icon={faLayerGroup} />
                        </NavLink>
                    </Tooltip>
                    {rootAdmin && (
                        <Tooltip placement={'bottom'} content={'Admin'}>
                            <a href={'/admin'} rel={'noreferrer'}>
                                <FontAwesomeIcon icon={faCogs} />
                            </a>
                        </Tooltip>
                    )}
                    <Tooltip placement={'bottom'} content={'Pengaturan Akun'}>
                        <NavLink to={'/account'}>
                            <span className={'flex items-center w-6 h-6 rounded-full ring-2 ring-yellow-400 overflow-hidden'}>
                                <Avatar.User />
                            </span>
                        </NavLink>
                    </Tooltip>
                    <Tooltip placement={'bottom'} content={'Keluar'}>
                        <button onClick={onTriggerLogout}>
                            <FontAwesomeIcon icon={faSignOutAlt} />
                        </button>
                    </Tooltip>
                </RightNavigation>
            </div>
        </div>
    );
};
