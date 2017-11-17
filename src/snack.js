import React from 'react';
import defaultSnack from '../public/images/snack.png';

export class Snack extends Component {
  constructor(props) {
    super(props);
    this.state = {
      name: 'Waseem'
    };
  }

  render() {
  	const { name } = this.state;
    return (
      <div className="card-header-container">
        <div className="snack">
          <img src={defaultSnack} />
        </div>
        <div className="name">
          <h2 className="title">{name}</h2>
        </div>
      </div>
    );
  }
}

export default Snack;