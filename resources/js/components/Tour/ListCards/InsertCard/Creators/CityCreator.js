import React, { Component } from "react";
import {
    Form,
    FormGroup,
    Label,
    Input,
    Container,
    Col,
    Row,
    Button,
    Card,
    CardBody,
    CardTitle,
    Modal,
    ModalHeader,
    ModalBody,
    ModalFooter
} from "reactstrap";
export default class CityCreator extends Component {
    constructor(props) {
        super(props);
        this.state = {
            modal: false,
            name: null,
            short_code: null
        };

        this.toggle = this.toggle.bind(this);

        // bind this into onchange so that we have access to this inside the method
        this.onChange = this.onChange.bind(this);
        this.onSubmit = this.onSubmit.bind(this);
    }

    onChange(e) {
        this.setState({ [e.target.name]: e.target.value });

        console.log(this.state);
    }

    onSubmit(e) {
        e.preventDefault();

        this.props.omitNewPlayfield({
            name: this.state.name,
            short_code: this.state.short_code
        });

        // const post = {
        //   title: this.state.title,
        //   body: this.state.body
        // };

        // fetch("https://jsonplaceholder.typicode.com/posts", {
        //   method: "POST",
        //   headers: {
        //     "content-type": "application/json"
        //   },
        //   body: JSON.stringify(post)
        // })
        //   .then(res => res.json())
        //   .then(data => console.log(data));
    }
    toggle() {
        this.setState({
            modal: !this.state.modal
        });
    }
    render() {
        return (
            <span className="d-inline-block mb-2 mr-2">
                <Button color="primary" onClick={this.toggle}>
                    Basic Modal
                </Button>
                <Modal
                    isOpen={this.state.modal}
                    toggle={this.toggle}
                    className={this.props.className}
                >
                    <ModalHeader toggle={this.toggle}>
                        Quick Create City
                    </ModalHeader>
                    <ModalBody>
                        {/* <Card className="main-card mb-3">
                            <CardBody>
                                <CardTitle>Grid Rows</CardTitle> */}
                        <Form>
                            <Row form>
                                <Col md={6}>
                                    <FormGroup>
                                        <Label for="name">Name</Label>
                                        <Input
                                            type="text"
                                            name="name"
                                            onChange={this.onChange}
                                            id="name"
                                            placeholder="City name"
                                        />
                                    </FormGroup>
                                </Col>
                                <Col md={6}>
                                    <FormGroup>
                                        <Label for="short_code">
                                            Short code
                                        </Label>
                                        <Input
                                            type="text"
                                            name="short_code"
                                            onChange={this.onChange}
                                            id="short_code"
                                            placeholder="password placeholder"
                                        />
                                    </FormGroup>
                                </Col>
                            </Row>
                        </Form>
                        {/* </CardBody>
                        </Card> */}
                    </ModalBody>
                    <ModalFooter>
                        <Button color="link" onClick={this.toggle}>
                            Cancel
                        </Button>
                        <Button color="primary" onClick={this.onSubmit}>
                            Save
                        </Button>{" "}
                    </ModalFooter>
                </Modal>
            </span>
        );
    }
}
