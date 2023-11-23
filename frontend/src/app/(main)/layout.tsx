import Navbar from '@/components/Navbar';

const Layout = ({ children }: { children: React.ReactNode }) => {
    return (
        <div className='w-screen h-screen flex relative bg-neutral-50'>
            <Navbar />
            <div className='p-9 flex flex-col gap-y-9 w-full'>{children}</div>
        </div>
    );
};

export default Layout;
