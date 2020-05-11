#!/bin/bash
cp stockAPI.service /etc/systemd/system/stockAPI.service
systemctl enable stockAPI.service
systemctl start stockAPI.service
systemctl status stockAPI.service
