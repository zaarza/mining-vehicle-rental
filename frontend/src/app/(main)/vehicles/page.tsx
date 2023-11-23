import { ArrowDownIcon } from '@/components/Icons';
import Button from '@/components/ui/Button';
import { Input } from '@/components/ui/Input';
import { H1 } from '@/components/ui/Heading';
import Select, { SelectOption } from '@/components/ui/Select';
import { Table, TableBody, TableData, TableHead, TableRow } from '@/components/ui/Table';

const Page = () => {
    return (
        <>
            <H1>Vehicles</H1>
            <span className='text-neutral-500'>
                Total Vehicles: <span className='text-amber-500'>42</span>
            </span>

            <div className='flex justify-between flex-wrap gap-y-2 gap-x-3'>
                <Select name='category'>
                    <SelectOption
                        disabled
                        selected
                    >
                        Select Category
                    </SelectOption>
                    <SelectOption>All</SelectOption>
                    <SelectOption>Goods</SelectOption>
                    <SelectOption>People</SelectOption>
                </Select>

                <Input
                    placeholder='SEARCH VEHICLE'
                    className='self-end justify-self-end bg-white'
                />
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
