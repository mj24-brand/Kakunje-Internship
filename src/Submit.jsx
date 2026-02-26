import React, { useState } from 'react'

const Submit = () => {
    const[email,setEmail]=useState("");

    const handleSubmit=(e)=>{
        e.preventDefault();
        alert(email)
    }
  return (
    <div>
      <form onSubmit={handleSubmit}>
        <input type="text" onChange={(e)=>setEmail(e.target.value)}/>
        <button type="submit">Submit</button>
      </form>
    </div>
  )
}

export default Submit
