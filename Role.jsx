import React from 'react'

const Role = () => {
    const role="admin";

    if(role==="admin"){
        return<h2>Admin dashboard</h2>
    }else{
  return <h2>user dashboard</h2>
}
}

export default Role;
