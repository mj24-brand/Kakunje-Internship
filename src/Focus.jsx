import React, { useState } from 'react'

const Focus = () => {
    const[status,setStatus]=useState("");
  return (
    <div>
      <input type='text'
      onFocus={()=>setStatus("input focused")}
      onBlur={()=>setStatus("input lost focus")}/>
      <p>{status}</p>
    </div>
  )
}

export default Focus
