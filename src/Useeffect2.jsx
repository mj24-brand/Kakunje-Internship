import React, { useEffect, useState } from 'react'

const Useeffect2 = () => {
    const [count,setCount]=useState(0);

    useEffect(()=>{
        console.log("count changed",count)
    },[count]);
  return (
    <div>
      <button onClick={()=>setCount(count+1)}>{count}</button>
    </div>
  )
}

export default Useeffect2
