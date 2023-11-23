import Button from './ui/Button';
import Input from './ui/Input';

const LoginForm = () => {
    return (
        <form className='bg-neutral-50 rounded-md p-11 flex flex-col gap-y-10 shadow-lg w-[90%] max-w-md'>
            <h1 className='text-2xl text-neutral-800 font-bold text-center'>LOG IN</h1>

            <div className='flex flex-col gap-y-8'>
                <Input
                    name='username'
                    placeholder='USERNAME'
                    type='text'
                />
                <Input
                    name='password'
                    placeholder='PASSWORD'
                    type='password'
                />

                <Button type='submit'>LOG IN</Button>
            </div>
        </form>
    );
};

export default LoginForm;
