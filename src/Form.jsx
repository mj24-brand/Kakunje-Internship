import React from 'react'
import  "./Form.css"

function Form(){
  const clicked=(e)=>{
    e.preventDefault();
    alert("Login Successful")
  }
  return (
    <div className='form-container'>
      <form onSubmit={Form}>
        <h2>Login Form</h2>
        <input type='email' name='email' placeholder='Enter your email'/>
         <input type='password'  placeholder='Enter your password'></input>
          <button type='submit' onClick={clicked}>Submit</button>
      </form>
    </div>
  )
}

export default Form
