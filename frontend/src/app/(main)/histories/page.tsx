import Button from '@/components/ui/Button';
import { H1 } from '@/components/ui/Heading';
import Select, { SelectOption } from '@/components/ui/Select';
import { Table, TableHead, TableRow, TableData, TableBody } from '@/components/ui/Table';

const Page = () => {
    return (
        <>
            <H1>History</H1>
            <span className='text-neutral-500'>
                Total History: <span className='text-amber-500'>42</span>
            </span>

            <div className='flex justify-between '>
                <div className='flex gap-x-4 flex-wrap gap-y-2'>
                    <div className='flex items-center gap-x-2'>
                        <span>From</span>
                        <input
                            type='date'
                            name=''
                            id=''
                            className='bg-white px-5 py-3 rounded-md border border-black/10'
                        />
                    </div>
                    <div className='flex items-center gap-x-2'>
                        <span>To</span>
                        <input
                            type='date'
                            name=''
                            id=''
                            className='bg-white px-5 py-3 rounded-md border border-black/10'
                        />
                    </div>
                    <Button>Export</Button>
                </div>
            </div>

            <Table>
                <TableHead>
                    <TableRow>
                        <TableData>
                            <input type='checkbox' />
                        </TableData>
                        <TableData>Lorem</TableData>
                        <TableData>Lorem</TableData>
                        <TableData>Lorem</TableData>
                        <TableData>Lorem</TableData>
                    </TableRow>
                </TableHead>
                <TableBody>
                    <TableRow>
                        <TableData>
                            <input type='checkbox' />
                        </TableData>
                        <TableData>Lorem</TableData>
                        <TableData>Lorem</TableData>
                        <TableData>Lorem</TableData>
                        <TableData>Lorem</TableData>
                    </TableRow>
                </TableBody>
            </Table>

            <Button className='w-fit self-end border border-black/10'>LOAD MORE</Button>
        </>
    );
};

export default Page;
