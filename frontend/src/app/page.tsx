import LoginForm from '@/components/LoginForm';
import Button from '@/components/ui/Button';
import Input from '@/components/ui/Input';
import Image from 'next/image';

export default function Home() {
    return (
        <div
            className='bg-amber-500 min-h-screen flex flex-col gap-y-8 items-center justify-center'
            style={{ backgroundImage: '/assets/images/background.jpg' }}
        >
            <div className='w-24 h-20 relative pointer-events-none'>
                <Image
                    quality={100}
                    src='/assets/images/logo-vertical.svg'
                    alt='App logo'
                    fill
                />
            </div>
            <LoginForm />
        </div>
    );
}
