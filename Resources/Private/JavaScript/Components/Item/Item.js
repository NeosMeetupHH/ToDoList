import { Component, propTypes } from '@reduct/component';
import ToDoListApi from '../../Api/ToDoListApi';

const schema = {
    'id': propTypes.isString.isRequired,
    'isDone': propTypes.isBoolean.isRequired,
    'endpoint': propTypes.isString.isRequired
};

class Item extends Component {
    constructor(el) {
        super(el, {
            props: el.dataset,
            propTypes: schema
        });

        this.setState('isDone', this.getProp('isDone'));

        this.api = new ToDoListApi(this.getProp('endpoint'), {
            item : this.getProp('id')
        });

        this.dom = {
            actionRemove: this.el.querySelector('[data-action="remove"]'),
            actionToggleState: this.el.querySelector('[data-action="toggleState"]')
        };

        this.removeItem = this.removeItem.bind(this);
        this.dom.actionRemove.addEventListener('click', this.removeItem);

        this.toggleState = this.toggleState.bind(this);
        this.dom.actionToggleState.addEventListener('click', this.toggleState);

        this.render = this.render.bind(this);
    }

    removeItem(e) {
        this.api.remove().then((xhr, result) => {
            if (result.type === 'success:remove') {
                this.el.remove();
                this.el = null;
                return;
            }

            throw result;
        }).catch(err => console.error(err));;
    }

    toggleState(e) {
        e.preventDefault();
        const op = this.getState('isDone') ? 'markAsUnDone' : 'markAsDone';

        this.api[op]()
            .then((xhr, result) => {
                if (result.type.startsWith('success')) {
                    this.setState('isDone', !this.getState('isDone'));
                    return;
                }

                throw result;
            })
            .then(this.render)
            .catch(err => console.error(err));

        return false;
    }

    render() {
        this.dom.actionToggleState.checked = this.getState('isDone');
    }
}

export default Item;