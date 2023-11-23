export const Label = (props: { htmlFor: string; label: string; children: JSX.Element }) => {
    const { htmlFor, label, children } = props;

    return (
        <label
            htmlFor={htmlFor}
            className='flex flex-col gap-y-1'
        >
            <span className='text-neutral-600 text-sm font-medium'>{label}</span>
            {children}
        </label>
    );
};

export const Input = (props: React.InputHTMLAttributes<HTMLInputElement>) => {
    const { ...attributes } = props;
    return (
        <input
            {...attributes}
            className='bg-transparent border text-sm border-black/10 rounded-md px-5 py-3 text-neutral-800 '
        />
    );
};

export const Error = (props: { text?: string }) => {
    const { text } = props;

    if (text && text.length > 0) {
        return <span className='text-sm text-red-500'>{text}</span>;
    }
};

const index = (props: { name: string; placeholder: string; type: string; error?: string }) => {
    const { name, placeholder, type, error } = props;

    return (
        <Label
            htmlFor={name}
            label={placeholder}
        >
            <>
                <Input
                    name={name}
                    placeholder={placeholder}
                    type={type}
                />
                <Error text={error} />
            </>
        </Label>
    );
};

export default index;
