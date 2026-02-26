import React from 'react'

const Form2 = () => {
    const [formData,setformData]=React.useState({
        name:"",
        email:""
    });

    const handleChange=(e)=>{
        const {name,value}=e.target;
        setformData((prevData)=>({
            ...prevData,
            [name]:value
        }));
        
    };

    const handleSubmit = (e) =>{
        e.preventDefault();
        console.log("Form Data:", formData);
    };

  return (
    <div>
      <form onSubmit={handleSubmit}>
        <input 
        type='text'
        name='name'
        placeholder='Enter name'
        value={formData.name}
        onChange={handleChange}
        />

        <input 
        type='email'
        name='email'
        placeholder='Enter email'
        value={formData.email}
        onChange={handleChange}
        />

        <button type='submit'>Submit</button>
      </form>

      <h3>Live Preview:</h3>
      <p>Name: {formData.name}</p>
      <p>Email: {formData.email}</p>
    </div>
  )
}

export default Form2
