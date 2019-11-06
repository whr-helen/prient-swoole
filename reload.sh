#!/usr/bin/env bash

#######手动.热重启.shell代码
pid=$(lsof -t -i:9503)
#三个信号需要注意：SIGTERM：停止服务器|SIGUSR1：重启worker|SIGUSR2：重启task worker
kill -USR1 $pid