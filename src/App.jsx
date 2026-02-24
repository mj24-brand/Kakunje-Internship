import React from 'react'
import New from './New';
import Inline from './Inline';
import Click from './Click';


function App(){
const name="Jyothika";

return(
  <div>
    <New/>
    <h1>hello {name}</h1>
    <p>hello world</p>
    <Inline/>
    <Click/>
  </div>
);
}
export default App;
