import React, { Component } from "react";

import Select from "react-select";
import { Row, Col, Button, CardTitle, FormGroup, Label } from "reactstrap";

export default class CitySelector extends Component {
    render() {
        const {
            omitSelectChange,
            playfield,
            cities,
            omitPlayfield
        } = this.props;

        return (
            <div>
                <CardTitle>Select a City</CardTitle>
                <Row form>
                    <Col md={12}>
                        <FormGroup>
                            <Label for="exampleEmail">Basic</Label>
                            <Select
                                value={playfield}
                                onChange={omitSelectChange()}
                                options={cities}
                            />
                        </FormGroup>
                    </Col>
                </Row>
                <Button onClick={omitPlayfield()}>Submit</Button>
            </div>
        );
    }
}
