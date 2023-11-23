interface IButtonProps extends React.ButtonHTMLAttributes<HTMLButtonElement> {
    children: JSX.Element | string;
    className?: string;
}
const Button = (props: IButtonProps) => {
    const { children, className, ...attributes } = props;

    return (
        <button
            className={`bg-amber-500 hover:brightness-110 active:brightness-125 rounded-md font-medium text-neutral-50 px-5 py-3 disabled:bg-neutral-300 ${className}`}
            {...attributes}
        >
            {children}
        </button>
    );
};

export default Button;
