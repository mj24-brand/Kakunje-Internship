import React from 'react'

const Parameter = () => {

    const handleClick=(name)=>{
        alert(`hello ${name}`);
    }

  return (
   <button onClick={()=>handleClick("MJ")}>Click here</button>
  )
}

export default Parameter
