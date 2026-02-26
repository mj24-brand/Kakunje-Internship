import React, { useState } from 'react'
import styles from "./Feedbackbtn.module.css";
function Feedback() {
    const [name,setName]=useState("");
    const [feedback,setFeedback]=useState("");
    const [message,setMessage]=useState("");
    const handleclick=(e)=>{
        e.preventDefault();
        setMessage(`Thank you ${name} for your feedback!`);
        setName("");
        setFeedback("");
    }
  return (
    <div className='forms'>
      <form onSubmit={handleclick}>
        <h2>Feedback form</h2>
        <input type='text' name='text' placeholder='enter your name' onChange={(e)=>setName(e.target.value)}></input>
        <textarea placeholder='Enter your feedback' onChange={(e)=>setFeedback(e.target.value)}></textarea><br></br>
        <button type='submit' className={styles.btn}>Submit</button>

      </form>
      <h3>{message}</h3>
    </div>
  )
}

export default Feedback
