import type { Metadata } from 'next';

export const metadata: Metadata = {
    title: 'Mining Vehicle Rental',
};

export default function Layout({ children }: { children: React.ReactNode }) {
    return (
        <html lang='en'>
            <body>{children}</body>
        </html>
    );
}
