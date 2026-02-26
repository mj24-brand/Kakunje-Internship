import React from 'react'

const Form1 = () => {
    const [name,setName]=React.useState("");
  return (
    <div>
      <input type='text' value={name} onChange={(e)=>setName(e.target.value)}/>
      <p>{name}</p>
    </div>
  )
}

export default Form1
