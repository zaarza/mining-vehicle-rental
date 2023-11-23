const variants = {
    PRIMARY: 'bg-amber-500 text-white',
    OUTLINE: 'bg-white text-neutral-800',
    DANGER: 'bg-red-500 text-white',
};

interface IButtonProps extends React.ButtonHTMLAttributes<HTMLButtonElement> {
    children: JSX.Element | string;
    className?: string;
    variant?: keyof typeof variants;
}

const Button = (props: IButtonProps) => {
    const { children, className, variant = 'PRIMARY', ...attributes } = props;

    return (
        <button
            className={`hover:brightness-110 border border-black/10 active:brightness-125 rounded-md font-medium text-neutral-50 px-5 py-3 disabled:bg-neutral-300 ${className} ${variants[variant]}`}
            {...attributes}
        >
            {children}
        </button>
    );
};

export default Button;
