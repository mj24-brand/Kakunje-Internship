import React, { useEffect } from 'react'

const Useeffect1 = () => {
    
    useEffect(()=>{
        console.log("component mounted")
    },[]);
  return (
    <div>hello </div>
  )
}

export default Useeffect1
