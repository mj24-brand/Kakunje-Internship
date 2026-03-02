import React, { useContext, useEffect, useRef, useState } from 'react'
import {ThemeContext} from '../context/ThemeContext';
import "../styles/Feedback.css"

const Feedback = () => {
    const [name,setName]=useState("");
    const [message,setMessage]=useState("");
    const [submitted,setSubmitted]=useState(false);
    const inputRef=useRef(null);
    const {theme}=useContext(ThemeContext)


    useEffect(()=>{
        inputRef.current.focus();
    },[]);

    const handleSubmit=(e)=>{
        e.preventDefault();
        setSubmitted(true);
    }
  return (
    
    <div className={`feedback ${theme}`}>
        <h2>FEEDBACK FORM</h2>
        {!submitted?(
            <form onSubmit={handleSubmit}>
                <input type="text" ref={inputRef} 
                placeholder='Enter your name' value={name} 
                onChange={(e)=>setName(e.target.value)}/>

                <textarea placeholder='Enter your feedback' 
                value={message} 
                onChange={(e)=>setMessage(e.target.value)}
                />

                <p>Charecters:{message.length}</p>
                <button type='submit'>Submit</button>       
            </form>
        ): (
            <h3>Thank you {name} for your feedback!</h3>
        )}

    </div>
  )
}

export default Feedback