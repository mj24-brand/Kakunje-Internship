import React from 'react'

const Child1 = React.memo (({name}) => {
    console.log("child rendered");

  return  <div>{name}</div>
});


export default Child1;
