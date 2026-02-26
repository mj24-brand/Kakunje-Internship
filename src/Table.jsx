import React from 'react'

const Table = () => {

    const users=[
        {id:1,name:"abc",age:22},
        {id:2,name:"xyz",age:21}
    ];
  return (
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
            </tr>
        </thead>
        <tbody>
            {users.map((user)=>(
                <tr key={user.id}>
                    <td>{user.name}</td>
                    <td>{user.age}</td>
                </tr>
            ))}
        </tbody>
    </table>
  )
}

export default Table
