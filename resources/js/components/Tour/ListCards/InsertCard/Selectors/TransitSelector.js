import React, { Component } from "react";

import Select from "react-select";
import { Row, Col, Button, CardTitle, FormGroup, Label } from "reactstrap";

export default class TransitSelector extends Component {
    render() {
        const {
            omitSelectChange,
            playfield,
            transits,
            omitPlayfield
        } = this.props;

        return (
            <div>
                <CardTitle>Select a Transit</CardTitle>
                <Row form>
                    <Col md={12}>
                        <FormGroup>
                            <Label for="exampleEmail">Basic</Label>
                            <Select
                                value={playfield}
                                onChange={omitSelectChange()}
                                options={transits}
                            />
                        </FormGroup>
                    </Col>
                </Row>
                <Button onClick={omitPlayfield()}>Submit</Button>
            </div>
        );
    }
}
