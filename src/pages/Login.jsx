import React from 'react'
//import { login } from '../services/authServices'
import { useState } from 'react'
import {useNavigate} from 'react-router-dom'
import API from "../services/api"

const Login = () => {
    const [form,setForm]=useState({
        email:"",
        password:""
    });

    const navigate=useNavigate();

    const handleSubmit = async (e) => {
    e.preventDefault();
    try {
        const res = await API.post("/auth/login", form);
        localStorage.setItem("token", res.data.token);
        alert("Login successful");
        navigate("/dashboard");
    } catch (err) {
        console.log(err);
        alert("Login failed");
    }
};
  return (
    <div className="container">
    <form onSubmit={handleSubmit}>
      <h2>Login Form</h2>

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

    <button>Login</button>

    </form>
    </div>
  )
}

export default Login
