import React, { useState, useEffect } from 'react';
import Modal from '@/components/elements/Modal';
import Button from '@/components/elements/Button';
import http from '@/api/http';
import Spinner from '@/components/elements/Spinner';
import tw from 'twin.macro';

interface Props {
    visible: boolean;
    onDismissed: () => void;
}

export default ({ visible, onDismissed }: Props) => {
    const [isLoading, setIsLoading] = useState(false);
    const [qrisPayload, setQrisPayload] = useState<string | null>(null);
    const [orderId, setOrderId] = useState<string | null>(null);
    const [status, setStatus] = useState<string>('idle');
    const [error, setError] = useState<string | null>(null);

    const onCheckout = () => {
        setIsLoading(true);
        setError(null);
        http.post('/api/client/store/checkout')
            .then(({ data }) => {
                if (data.success) {
                    setQrisPayload(data.qris_payload);
                    setOrderId(data.order_id);
                    setStatus('pending');
                } else {
                    setError(data.message || 'Gagal memproses pembayaran.');
                }
            })
            .catch((err) => {
                setError(err.response?.data?.message || 'Terjadi kesalahan sistem.');
            })
            .finally(() => {
                setIsLoading(false);
            });
    };

    useEffect(() => {
        let interval: NodeJS.Timeout;
        if (status === 'pending' && orderId) {
            interval = setInterval(() => {
                http.get(`/api/client/store/status/${orderId}`)
                    .then(({ data }) => {
                        if (data.status === 'paid' || data.status === 'completed' || data.status === 'success') {
                            setStatus('success');
                            clearInterval(interval);
                        }
                    });
            }, 5000);
        }
        return () => clearInterval(interval);
    }, [status, orderId]);

    return (
        <Modal visible={visible} onDismissed={onDismissed} showSpinnerOverlay={isLoading}>
            <div css={tw`mb-6`}>
                <h2 css={tw`text-2xl mb-2 text-neutral-100`}>MantaCil Store</h2>
                {status === 'idle' && (
                    <>
                        <p css={tw`text-neutral-300 mb-6`}>
                            Beli paket <strong>Server Bot WA + Subdomain Keren</strong> secara instan tanpa perlu menunggu admin.
                            Hanya <strong>Rp5.000</strong> per server!
                        </p>
                        <div css={tw`flex justify-end`}>
                            <Button type={'button'} isSecondary onClick={onDismissed} css={tw`mr-4`}>
                                Batal
                            </Button>
                            <Button type={'button'} color={'green'} onClick={onCheckout}>
                                Beli Sekarang (Rp5.000)
                            </Button>
                        </div>
                    </>
                )}

                {status === 'pending' && qrisPayload && (
                    <div css={tw`text-center`}>
                        <p css={tw`text-neutral-300 mb-4`}>
                            Silakan scan QRIS di bawah ini menggunakan aplikasi DANA, Gopay, OVO, atau M-Banking Anda.
                        </p>
                        <div css={tw`bg-white p-4 rounded-lg inline-block mb-4`}>
                            <img src={qrisPayload} alt="QRIS" css={tw`w-48 h-48`} />
                        </div>
                        <p css={tw`text-yellow-400 font-bold mb-4`}>
                            Menunggu pembayaran... <Spinner size={'small'} />
                        </p>
                    </div>
                )}

                {status === 'success' && (
                    <div css={tw`text-center`}>
                        <div css={tw`text-green-500 mb-4`}>
                            <svg className="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h3 css={tw`text-xl text-green-400 font-bold mb-2`}>Pembayaran Berhasil!</h3>
                        <p css={tw`text-neutral-300 mb-4`}>
                            Server Anda sedang dibuat otomatis. Silakan refresh (F5) halaman Dasbor dalam beberapa detik.
                        </p>
                        <Button type={'button'} onClick={() => window.location.reload()}>
                            Selesai
                        </Button>
                    </div>
                )}

                {error && (
                    <div css={tw`mt-4 p-3 bg-red-500/20 text-red-400 rounded`}>
                        {error}
                    </div>
                )}
            </div>
        </Modal>
    );
};
