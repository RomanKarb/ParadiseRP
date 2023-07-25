import discord
from discord.ext import commands

intents = discord.Intents.default()
intents.reactions = True
intents.messages = True
intents.guilds = True
intents.message_content = True

bot = commands.Bot(command_prefix='!', intents=intents)

@bot.event
async def on_ready():
    print(f'Logged in as {bot.user.name}')

@bot.event
async def on_raw_reaction_add(payload):
    server_id = 1123971136611422210
    category_id = 1124211068491800639
    channel_id = 1124211118513066004
    message_id = 1125837310290829333
    granted_role_ids = [1123971313594282075, 1123971426387492955]  # Здесь укажите идентификаторы ролей с доступом к каналу

    if payload.guild_id == server_id and payload.channel_id == channel_id and payload.message_id == message_id and str(payload.emoji) == '✅':
        server = bot.get_guild(server_id)
        category = discord.utils.get(server.categories, id=category_id)
        channel_number = len(category.channels) + 1

        overwrites = {
            server.default_role: discord.PermissionOverwrite(read_messages=False),
            server.me: discord.PermissionOverwrite(read_messages=True),
        }

        for role_id in granted_role_ids:
            role = discord.utils.get(server.roles, id=role_id)
            overwrites[role] = discord.PermissionOverwrite(read_messages=True)

        new_channel = await category.create_text_channel(f'Тикет - {channel_number:04}', overwrites=overwrites)

        await new_channel.send('Закрыть тикет')
        await new_channel.send('Вы уверены?')

@bot.event
async def on_raw_reaction_remove(payload):
    server_id = 1123971136611422210
    channel_id = 1124211118513066004
    message_id = 1125837310290829333

    if payload.guild_id == server_id and payload.channel_id == channel_id and payload.message_id == message_id and str(payload.emoji) == '❌':
        channel = bot.get_channel(payload.channel_id)
        await channel.delete()

bot.run("MTEyNTgwMTY1MTQ1OTA3MjExMA.GXGgbR.HP2hbrx7VhC1ZcmjmYD8OTohPoXPzW_oxjFEdk")