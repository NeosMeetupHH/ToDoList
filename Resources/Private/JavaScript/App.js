import assembler from '@reduct/assembler';

// Components
import List from './Components/List/List';

// Instantiate components all over the dom
const app = assembler();

app.register(List);

app.run();