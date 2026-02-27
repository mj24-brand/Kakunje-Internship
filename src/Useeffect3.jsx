import React, { useEffect } from 'react'

const Useeffect3 = () => {
    useEffect(()=>{
        const interval=setInterval(()=>{
            console.log("running..");
        },1000);
        return()=>{
            clearInterval(interval);
        };
    },[],)
  return (
    <div>timer..</div>
  )
}

export default Useeffect3
