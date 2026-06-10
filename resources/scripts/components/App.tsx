import React, { lazy } from 'react';
import { hot } from 'react-hot-loader/root';
import { Route, Router, Switch } from 'react-router-dom';
import { StoreProvider } from 'easy-peasy';
import { store } from '@/state';
import { SiteSettings } from '@/state/settings';
import ProgressBar from '@/components/elements/ProgressBar';
import { NotFound } from '@/components/elements/ScreenBlock';
import tw from 'twin.macro';
import GlobalStylesheet from '@/assets/css/GlobalStylesheet';
import { history } from '@/components/history';
import { setupInterceptors } from '@/api/interceptors';
import AuthenticatedRoute from '@/components/elements/AuthenticatedRoute';
import { ServerContext } from '@/state/server';
import '@/assets/tailwind.css';
import Spinner from '@/components/elements/Spinner';

const DashboardRouter = lazy(() => import(/* webpackChunkName: "dashboard" */ '@/routers/DashboardRouter'));
const ServerRouter = lazy(() => import(/* webpackChunkName: "server" */ '@/routers/ServerRouter'));
const AuthenticationRouter = lazy(() => import(/* webpackChunkName: "auth" */ '@/routers/AuthenticationRouter'));

interface ExtendedWindow extends Window {
    SiteConfiguration?: SiteSettings;
    MantaCilUser?: {
        uuid: string;
        username: string;
        email: string;
        /* eslint-disable camelcase */
        root_admin: boolean;
        use_totp: boolean;
        language: string;
        updated_at: string;
        created_at: string;
        /* eslint-enable camelcase */
    };
}

setupInterceptors(history);

const App = () => {
    const { MantaCilUser, SiteConfiguration } = window as ExtendedWindow;
    if (MantaCilUser && !store.getState().user.data) {
        store.getActions().user.setUserData({
            uuid: MantaCilUser.uuid,
            username: MantaCilUser.username,
            email: MantaCilUser.email,
            language: MantaCilUser.language,
            rootAdmin: MantaCilUser.root_admin,
            useTotp: MantaCilUser.use_totp,
            createdAt: new Date(MantaCilUser.created_at),
            updatedAt: new Date(MantaCilUser.updated_at),
        });
    }

    if (!store.getState().settings.data) {
        store.getActions().settings.setSettings(SiteConfiguration!);
    }

    return (
        <>
            <GlobalStylesheet />
            <StoreProvider store={store}>
                <ProgressBar />
                <div css={tw`mx-auto w-auto`}>
                    <Router history={history}>
                        <Switch>
                            <Route path={'/auth'}>
                                <Spinner.Suspense>
                                    <AuthenticationRouter />
                                </Spinner.Suspense>
                            </Route>
                            <AuthenticatedRoute path={'/server/:id'}>
                                <Spinner.Suspense>
                                    <ServerContext.Provider>
                                        <ServerRouter />
                                    </ServerContext.Provider>
                                </Spinner.Suspense>
                            </AuthenticatedRoute>
                            <AuthenticatedRoute path={'/'}>
                                <Spinner.Suspense>
                                    <DashboardRouter />
                                </Spinner.Suspense>
                            </AuthenticatedRoute>
                            <Route path={'*'}>
                                <NotFound />
                            </Route>
                        </Switch>
                    </Router>
                </div>
            </StoreProvider>
        </>
    );
};

export default hot(App);
