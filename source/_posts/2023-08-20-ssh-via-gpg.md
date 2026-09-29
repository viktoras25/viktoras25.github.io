---
extends: _layouts.post
section: content
title: "SSH via GPG"
tags: [ssh, gpg]
categories: []
published: false
language: en
post_date: 20.08.2023
---

This post is a summary of how I use SSH via GPG and backup the keys. I'm writing it down for myself and to share with friends and colleagues. My setup is not ultimately secure, but it's secure and practical enough for me. At every step you can choose to harden the configuration even more and add hardware tokens like Yubikey. My motivation is having to deal with one keychain only and being able to have an offline hardcopy (printable QR code) backup, because all electronics can go bad when you least expect it.

### Preparations

I used this article https://github.com/drduh/YubiKey-Guide as a source for most of the information here.

We start off with having a proper GPG keychain. There are numerous guides to creating a keychain, I will only provide a quick walkthrough without too much explanation. One thing to notice, you want to create an ECC key (Ed25519). It provides similar security level, while having a much smaller key size. Since we are going to print the key out as a QR code, we have to keep it's limitations in mind. A single QR code can contain around 3kb of data, so an RSA4096 key will not fit. And we also want some redundancy in the QR code, limiting the payload even more. There are of course ways around it, you can break it up into multiple QR codes or use a different encoding, like Data Matrix. I choose to just use an ECC key.

Here I make the first security/practicality tradeoff. For maximum security, you can choose to create the master key on a separate machine, that never ever connects to any network, transfer it to Yubikey and wipe it. This way you can ensure, that your master key will never be compromised. If you are a high-value target, your current machine can already be keylogged, so creating a new key there is not 100% secure. I am accepting this risk and proceed on my daily laptop.

An absolute must is to set a secure passphrase for a key. Again, internet recommends generating a passphrase using e.g. diceware to exclude any possible electronic traces. I don't do it, even thought it's fun. Just remember, if your key does get stolen, this passphrase will be the last and only level of your defense. We are going to backup the private key as a QR code, so a copy is theoretically obtainable.

### Creating and enabling the key

    gpg --full-generate-key --expert
    gpg --list-keys
    gpg --expert --edit-key MASTER_KEY_ID

A proper key management includes a master key with only certify capability and 3 sub-keys. For that, choose item 11, disable sign capability leaving certify only, the rest is default. After master key, add 3 sub-keys - sign, encrypt, authenticate. Sign can be used for signing git commits, encrypt for secure email communication, authenticate for SSH. I do it, because I like the structure with sub-keys, but you don't have to.

Now you have a key you can use. You need to enable SSH support in a GPG agent and setup SSH socket.

    echo enable-ssh-support >> ~/.gnupg/gpg-agent.conf
    echo "export SSH_AUTH_SOCK=\$(gpgconf --list-dirs agent-ssh-socket)" >> ~/.bashrc
    gpg --list-keys --with-keygrip
    echo SUB_KEY_ID >> ~/.gnupg/sshcontrol
    gpg-connect-agent reloadagent /bye
    ssh-add -L

Now you should be able to see a key available for SSH authentication.

    gpg --export-ssh-key MASTER_KEY_ID

Add it to the desired server/service, like Github for example and test it.

    ssh -T git@github.com

### Backup

This part is largely inspired by https://wiki.archlinux.org/title/Paperkey.

    gpg --export-secret-key KEY_ID | qrencode -s10 --output test-qr.png
