import React from 'react'
import {Usecounter} from './Usecounter'

const Counter5 = () => {
    const {count,increment,decrement,reset}=Usecounter(0);
  return (
    <div style={{textAlign:"center",marginTop:"50px"}}>
        <h2>Custom hook counter</h2>
      <h1>{count}</h1>

      <button onClick={increment}>+</button>
      <button onClick={decrement}>-</button>

      <button onClick={reset}>reset</button>
    </div>
  )
}

export default Counter5
