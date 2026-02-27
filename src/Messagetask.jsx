import React, { useEffect, useRef, useState } from 'react'

const Messagetask = () => {
    const [show,setShow]=useState(false);
    const inputElement=useRef();

    useEffect(()=>{
        if(show) {
            inputElement.current.focus();
        }
    },[show]);
  return (
    <div>
      {show && <input type='text' ref={inputElement}></input>}
      <button onClick={()=>setShow(!show)}>
        {show ? "Hide message" : "Show Message"}</button>
    </div>
  )
}

export default Messagetask
