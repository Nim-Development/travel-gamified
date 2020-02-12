import React, { Component } from "react";

import Select from "react-select";
import { Row, Col, Button, CardTitle, FormGroup, Label } from "reactstrap";

export default class RouteSelector extends Component {
    render() {
        const {
            omitSelectChange,
            playfield,
            routes,
            omitPlayfield
        } = this.props;

        return (
            <div>
                <CardTitle>Select a Route</CardTitle>
                <Row form>
                    <Col md={12}>
                        <FormGroup>
                            <Label for="exampleEmail">Basic</Label>
                            <Select
                                value={playfield}
                                onChange={omitSelectChange()}
                                options={routes}
                            />
                        </FormGroup>
                    </Col>
                </Row>
                <Button onClick={omitPlayfield()}>Submit</Button>
            </div>
        );
    }
}
