import { ReactNode, useEffect, useState } from 'react';
import { createPortal } from 'react-dom';

type TModalProps = {
    show: boolean;
    toggleShow: () => void;
    children: ReactNode;
    title: string;
};

const Modal = (props: TModalProps) => {
    const { show, children, toggleShow, title } = props;
    const [documentReady, setDocumentReady] = useState<boolean>(false);

    useEffect(() => {
        setDocumentReady(true);
    }, []);

    if (show && documentReady) {
        return (
            <>
                {createPortal(
                    <div
                        className='bg-black/10 z-50 flex justify-center items-center absolute top-0 left-0 bottom-0 right-0'
                        id='modal'
                    >
                        <div className='min-w-[400px] rounded-md shadow-md bg-white relative overflow-hidden'>
                            <div className='flex justify-center items-center bg-amber-500 py-2'>
                                <h1 className='text-white font-medium'>{title}</h1>
                                <button
                                    type='button'
                                    onClick={() => toggleShow()}
                                    className=' w-6 aspect-square absolute right-2'
                                >
                                    <svg
                                        xmlns='http://www.w3.org/2000/svg'
                                        viewBox='0 0 24 24'
                                        className='fill-white'
                                    >
                                        <path d='M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z'></path>
                                    </svg>
                                </button>
                            </div>
                            {children}
                        </div>
                    </div>,
                    document.body
                )}
            </>
        );
    }
};

export default Modal;
