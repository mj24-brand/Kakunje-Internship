import React from 'react'
import { useState } from 'react'
//import { register } from '../services/authServices';
import API from "../services/api"
import { useNavigate } from 'react-router-dom';

const Register = () => {
    const [form,setForm]=useState({
        name:"",
        email:"",
        password:""
    });
    const navigate=useNavigate();

    const handleSubmit=async(e)=>{
        e.preventDefault();
        await API.post("/auth/register",form);
        navigate("/");
        alert("registered succesfully");
    }


  return (
    <div className="container">
   <form onSubmit={handleSubmit}>
    <h2>Register Form</h2>

    <div className="input-group">
      <i className="bi bi-person"></i>
    <input type="text" placeholder='enter name' 
    onChange={(e)=>setForm({...form,name:e.target.value})}/>
    </div>

    <div className="input-group">
      <i className="bi bi-envelope"></i>
    <input type="text" placeholder='enter email' 
    onChange={(e)=>setForm({...form,email:e.target.value})}/>
    </div>

    <div className="input-group">
      <i className="bi bi-lock"></i>
    <input type="text" placeholder='enter password' 
    onChange={(e)=>setForm({...form,password:e.target.value})}/>
    </div>

    <button>Register</button>
   </form>
   </div>
  )
}

export default Register
