import { ArrowDownIcon } from '../Icons';

interface ISelectOptionProps extends React.OptionHTMLAttributes<HTMLOptionElement> {
    children: React.ReactNode;
}

export const SelectOption = (props: ISelectOptionProps) => {
    const { children, ...attributes } = props;

    return <option {...attributes}>{children}</option>;
};

interface ISelectProps extends React.SelectHTMLAttributes<HTMLSelectElement> {
    name: string;
    children: React.ReactNode;
}

const Select = (props: ISelectProps) => {
    const { name, children, ...attributes } = props;

    return (
        <label
            htmlFor={name}
            className='bg-orange-50 cursor-pointer rounded-md flex items-center px-5 py-3 border border-black/10 gap-x-3'
        >
            <select
                {...attributes}
                className='text-amber-500 bg-transparent appearance-none'
            >
                {children}
            </select>
            <div className='fill-amber-500 w-4 aspect-square'>
                <ArrowDownIcon />
            </div>
        </label>
    );
};

export default Select;
