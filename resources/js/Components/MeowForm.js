import { useState } from 'react';
import { useForm, Controller } from 'react-hook-form';
import CreatableSelect from 'react-select/creatable';
import Label from '@/Components/Label';
import { registerComponentToDom } from '@/utils';
import axios from 'axios';

export function MeowForm ({ tags = [] }) {
  const [success, setSuccess] = useState(null);
  const { register, handleSubmit, control } = useForm({
    defaultValues: {
      content: '',
      tags: []
    }
  });

  function onSubmit ({ content, tags }) {
    setSuccess(null);

    axios
      .post('/user/meows', {
        content,
        tags: tags.map(t => t.value),
        _token: document.querySelector('meta[name="csrf-token"]').content
      })
      .then(res => {
        setSuccess('You have Meowed...');
        window.location.assign('/user/meows');
      });
  }

  function handleChange (newValue, actionMeta) {
    setData('tags', newValue);
  }

  return (
    <form onSubmit={handleSubmit(onSubmit)}>
      <div>
        <Label forInput='meow-content' value='Mew Meow' />
        <textarea
          className='rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full'
          id='meow-content'
          required
          {...register('content', { required: true })}
        ></textarea>
      </div>
      <div>
        <Label forInput='tag-select' value='Tags' />
        <Controller
          name='tags'
          control={control}
          render={({ field }) => (
            <CreatableSelect
              isMulti
              id='tag-select'
              options={tags.map(({ tag }) => ({ value: tag, label: tag }))}
              {...field}
            />
          )}
        />
      </div>
      {success && (
        <div>
          <span>{success}</span>
        </div>
      )}
      <button
        className='inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'
        type='submit'
      >
        Meow
      </button>
    </form>
  );
}

registerComponentToDom('meow-form', MeowForm);
