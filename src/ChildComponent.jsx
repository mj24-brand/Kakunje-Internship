import React, { useContext } from 'react'
import UserContext from './UserContext'

const ChildComponent = () => {
    const user=useContext(UserContext);
  return (
    <div>ChildComponent {user}</div>
  )
}

export default ChildComponent
