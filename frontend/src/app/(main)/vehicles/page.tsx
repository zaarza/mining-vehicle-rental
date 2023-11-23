'use client';
import Button from '@/components/ui/Button';
import InputGroup, { Input } from '@/components/ui/Input';
import { H1 } from '@/components/ui/Heading';
import Select, { SelectOption } from '@/components/ui/Select';
import { Table, TableBody, TableData, TableHead, TableRow } from '@/components/ui/Table';
import { useState } from 'react';
import Modal from '@/components/Modal';

const Page = () => {
    const [showDetailDataModal, setShowDetailDataModal] = useState<boolean>(false);

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
                    <TableRow onClick={() => setShowDetailDataModal((currentValue) => !currentValue)}>
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

            <Modal
                show={showDetailDataModal}
                toggleShow={() => setShowDetailDataModal((currentValue) => !currentValue)}
                title='VEHICLE ACTIONS'
            >
                <form className='px-5 py-3 flex flex-col gap-y-5'>
                    <InputGroup
                        name='name'
                        placeholder='Name'
                        type='text'
                    />
                    <InputGroup
                        name='brand'
                        placeholder='Brand'
                        type='text'
                    />
                    <InputGroup
                        name='company'
                        placeholder='Company'
                        type='text'
                    />
                    <InputGroup
                        name='fuel_usage_per_hour'
                        placeholder='Fuel Usage / H'
                        type='number'
                    />

                    <div className='flex gap-x-5 justify-items-end'>
                        <Button
                            className='w-fit'
                            variant='OUTLINE'
                        >
                            CANCEL
                        </Button>
                        <Button className='w-fit'>UPDATE</Button>
                    </div>
                </form>
            </Modal>
        </>
    );
};

export default Page;
