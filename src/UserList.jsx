import React from 'react'

const UserList = () => {
    const users=[
        {id:1,name:"abc"},
        {id:2,name:"xyz"}
    ];
  return (
    <div>
      {users.map((user)=>(
        <h3 key={user.id}>{user.name}</h3>
      ))}
    </div>
  )
}

export default UserList
