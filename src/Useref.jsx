import React, { useEffect, useRef,useState } from 'react'

const Useref = () => {
    const [inputValue,setInputValue]=useState('');
    const count=useRef(0);

    useEffect(()=>{
        count.current=count.current+1;
    })
  return (
    <div>
      <p></p>
      <input type="text" value={inputValue} 
      onChange={(e)=>setInputValue(e.target.value)}/>
      <h1> {count.current} </h1>
    </div>
  )
}

export default Useref
