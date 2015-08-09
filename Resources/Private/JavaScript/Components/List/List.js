import { Component, propTypes } from '@reduct/component';
import Item from '../Item/Item';
import ToDoListApi from '../../Api/ToDoListApi';

const schema = {
    'id': propTypes.isString.isRequired,
    'endpoint': propTypes.isString.isRequired
};

function _convertApiResultToDOMNode(xhr, result) {
    if (result.type.startsWith('success')) {
        let parser = new DOMParser();
        let doc = parser.parseFromString(result.view, "text/html");
        let newItem = doc.querySelector('body > *');

        return newItem;
    }

    console.error(result);
}

function _initializeListItem(itemNode) {
    return new Item(itemNode);
}

class List extends Component {
    constructor(el) {
        super(el, {
            props: el.dataset,
            propTypes: schema
        });

        this.api = new ToDoListApi(this.getProp('endpoint'), {
            list : this.getProp('id')
        });

        this.dom = {
            inputLabel: this.el.querySelector('[data-input="label"]'),
            list: this.el.querySelector('ul'),

            addItem: (newItem) => {
                this.dom.list.appendChild(newItem);
                this.dom.inputLabel.value = '';
                this.dom.inputLabel.focus();

                return newItem;
            }
        };

        this.addItem = this.addItem.bind(this);
        this.dom.inputLabel.addEventListener('keyup', this.addItem);

        [].slice.call(this.dom.list.querySelectorAll('li')).forEach(_initializeListItem);
    }

    addItem(e) {
        if (e.keyCode === 13) {
            let label = this.dom.inputLabel.value;

            if (label !== '') {
                this.api.add(label)
                    .then(_convertApiResultToDOMNode)
                    .then(this.dom.addItem)
                    .then(_initializeListItem)
                    .catch((err) => console.error(err));
            }
        }
    }
}

export default List;