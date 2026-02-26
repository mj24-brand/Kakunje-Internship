import React from 'react'
import Child1 from './Child1';

const Parent = () => {
    const[count,setCount]=React.useState(0);
  return (
    <div>
      <Child1 name="Jyothika"/>
      <button onClick={()=>setCount(count+1)}>increase</button>
    </div>
  )
}

export default Parent
