#!/usr/bin/env bash

# Based on https://github.com/opdavies/dotfiles/blob/main/bin/t.

set -o errexit
set -o nounset

session_name="${1:-atdc}"
session_path="${2:-$(pwd)}"

if tmux has-session -t="${session_name}" 2> /dev/null; then
  tmux attach -t "${session_name}"
  exit
fi

tmux new-session -d -s "${session_name}" -n vim -c "${session_path}"

# 1. Main window: Vim, server, shell
tmux split-pane -t "${session_name}:vim" -h -c "${session_path}" -p 40
tmux send-keys -t "${session_name}:vim" "nvim" Enter
tmux send-keys -t "${session_name}:vim.right" "php -S 0.0.0.0:9000 -t web" Enter
tmux split-pane -t "${session_name}:vim" -c "${session_path}" -v
tmux send-keys -t "${session_name}:vim.bottom-right" "watch-changes web/modules/custom phpunit" Enter

# 2. General shell use.
tmux new-window -t "${session_name}" -c "${session_path}"

tmux switch-client -t "${session_name}:vim.left" ||
  tmux attach -t "${session_name}:vim.left"
