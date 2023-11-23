'use client';

import Chart from 'react-apexcharts';
import { H1 } from '@/components/ui/Heading';

export default function Home() {
    const options = {
        chart: {
            id: 'basic-bar',
        },
        xaxis: {
            categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998],
        },
    };
    const series = [
        {
            name: 'series-1',
            data: [30, 40, 45, 50, 49, 60, 70, 91],
        },
    ];
    return (
        <>
            <H1>Usages</H1>

            <Chart
                options={options}
                series={series}
                type='bar'
                width={'100%'}
            />
        </>
    );
}
