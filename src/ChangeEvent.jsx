import React, { useState } from 'react'

const ChangeEvent = () => {
    const [name,setName]=useState("");


  return (
    <div>
      <input type="text" onChange={(e)=>setName(e.target.value)}>
      </input>
      <h2>{name}</h2>
    </div>
  )
}

export default ChangeEvent
