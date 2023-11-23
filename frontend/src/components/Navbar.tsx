'use client';

import Image from 'next/image';
import { ReactNode, useState } from 'react';
import { CarIcon, ChartIcon, HistoryIcon, LogoutIcon } from './Icons';
import Link from 'next/link';
import { usePathname } from 'next/navigation';

type TNavbarLinkProps = {
    icons: ReactNode;
    text: string;
    active?: boolean;
    href: string;
    onClick?: () => void;
};

const NavbarLink = (props: TNavbarLinkProps) => {
    const { icons, text, active, href, onClick } = props;

    return (
        <Link
            href={href}
            onClick={onClick}
        >
            <div className={`flex gap-x-8 items-center px-7 py-3 rounded-md ${active ? 'bg-orange-50' : 'bg-white'}`}>
                <div className={`w-6 aspect-square ${active ? 'fill-amber-500' : 'fill-neutral-800'}`}>{icons}</div>
                <span className={`${active ? 'text-amber-500' : 'text-neutral-800'}`}>{text}</span>
            </div>
        </Link>
    );
};

const Navbar = () => {
    const pathName = usePathname();
    const [active, setActive] = useState<boolean>(false);

    return (
        <>
            <button
                className='w-11 lg:hidden aspect-square absolute top-2 right-2 bg-white shadow-md p-1 rounded-md first:fill-neutral-800'
                type='button'
                onClick={() => setActive((currentValue) => !currentValue)}
            >
                <svg
                    xmlns='http://www.w3.org/2000/svg'
                    viewBox='0 0 24 24'
                >
                    <path d='M3 4H21V6H3V4ZM3 11H21V13H3V11ZM3 18H21V20H3V18Z'></path>
                </svg>
            </button>
            <nav
                className={`min-w-[350px] z-30 border-r border-r-black/10 lg:sticky duration-300 absolute top-0 bg-white h-screen p-6 flex flex-col gap-y-14 ${
                    active ? 'left-0' : 'left-[-100%]'
                }`}
            >
                <div className='w-full h-24 relative'>
                    <Image
                        src='/assets/images/logo-vertical-amber.svg'
                        alt='App logo'
                        fill
                    />
                </div>
                <div className='flex flex-col gap-y-2 h-full'>
                    <NavbarLink
                        icons={<ChartIcon />}
                        text='Usages'
                        href='/'
                        active={pathName === '/'}
                        onClick={() => setActive((currentValue) => !currentValue)}
                    />

                    <NavbarLink
                        icons={<CarIcon />}
                        text='Vehicles'
                        href='/vehicles'
                        active={pathName === '/vehicles'}
                        onClick={() => setActive((currentValue) => !currentValue)}
                    />

                    <NavbarLink
                        icons={<HistoryIcon />}
                        text='History'
                        href='/histories'
                        active={pathName === '/histories'}
                        onClick={() => setActive((currentValue) => !currentValue)}
                    />

                    <div className='mt-auto'>
                        <NavbarLink
                            icons={<LogoutIcon />}
                            text='Logout'
                            href='/logout'
                            onClick={() => confirm('Logout?')}
                        />
                    </div>
                </div>
            </nav>
        </>
    );
};

export default Navbar;
