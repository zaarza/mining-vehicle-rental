export const TableData = ({ children }: { children: React.ReactNode }) => {
    return <td className='px-3 py-2'>{children}</td>;
};

export const TableRow = ({ children }: { children: React.ReactNode }) => {
    return <tr className='border-b border-b-black/10'>{children}</tr>;
};

export const TableHead = ({ children }: { children: React.ReactNode }) => {
    return <thead className='bg-amber-500 text-neutral-50 font-medium'>{children}</thead>;
};

export const TableBody = ({ children }: { children: React.ReactNode }) => {
    return <tbody>{children}</tbody>;
};

export const Table = ({ children }: { children: React.ReactNode }) => {
    return (
        <div className='border border-b-0 border-black/10 rounded-md overflow-hidden'>
            <table className='bg-white w-full'>{children}</table>
        </div>
    );
};
