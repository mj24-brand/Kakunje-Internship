import React from 'react'

const BasicList = () => {
    const fruits=["apple","orange","mango"];

  return (
    <ul>
        {fruits.map((fruit,index)=>(
            <li key={index}>{fruit}</li>
        ))}
    </ul>
  )
}

export default BasicList
